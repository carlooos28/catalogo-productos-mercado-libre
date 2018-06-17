<?php

namespace app\controllers;
use Yii;
// use app\models\Customer;
// use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class ProductController extends Controller
{
	
	public  $endPoint  = 'https://api.mercadolibre.com/categories/'; 
	public  $category  = [ "MCO1384", "MCO40433", "MCO1051", "MCO1132"];
	private $itemRand  = 0;
	private $categoryData  = [];
	private $products      = [];	

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                ],
            ]
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
        ];
    }

    public function actionIndex()
    {        
    	$this->itemRand = array_rand($this->category);

        // Result is parsed JSON array
        $this->categoryData = Yii::$app->httpclient->get($this->endPoint.$this->category[$this->itemRand]);

        foreach($this->categoryData["children_categories"] as $item)
        {

            $this->products[] = Yii::$app->httpclient->get("{$this->endPoint}{$item["id"]}");
        }        

        return $this->render('index', ['category' => $this->categoryData, 'products' => $this->products]);        
    }

}