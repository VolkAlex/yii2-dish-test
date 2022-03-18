<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderItem;
use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\helpers\Order as OrderHelper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionOrder()
    {
        $product = new Product();

        $testCustomerId = 1;
        $testOrderState = 1;

        $request = Yii::$app->request->post();

        if ($request) {
            try {
                $orderItems = OrderHelper::parseFormRequest($request);

                $order = new Order();
                $order->setAttribute('customer_id', $testCustomerId);
                $order->setAttribute('state_id', $testOrderState);
                $order->save();

                foreach ($orderItems as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->setAttributes($item);
                    $orderItem->setAttribute('order_id', $order->getAttribute('id'));
                    if ($orderItem->validate()) {
                        $orderItem->save();
                    }
                }

                $itemsWithPrice = OrderHelper::addProductAttributesToOrderItem($orderItems);

                return $this->render('orderPlaced', [
                    'orderItems' => $itemsWithPrice,
                    'totalPrice' => OrderHelper::getTotalPrice($itemsWithPrice)
                ]);

            } catch (\Exception $exception) {

            }
        }

        return $this->render('order', [
            'orderItem' => new OrderItem(),
            'products' => $product::find()->all()
        ]);
    }

    /**
     * @return array
     * @throws ForbiddenHttpException
     */
    public function actionAddOrderItem()
    {
        if (Yii::$app->request->isAjax) {
            $product = new Product();
            $orderItem = new OrderItem();

            $content = $this->renderPartial('/templates/orderItem',[
                'orderItem' => $orderItem,
                'products' => $product::find()->all(),
            ]);

            Yii::$app->response->setStatusCode(200);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'response' => Json::encode($content),
                'format' => Response::FORMAT_JSON,
            ];
        }

        throw new ForbiddenHttpException();
    }
}
