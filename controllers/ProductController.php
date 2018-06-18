<?php

namespace app\controllers;
use Yii;
use app\models\ShoppingCart;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class ProductController extends Controller
{
	
	private $endPoint  = 'https://api.mercadolibre.com/categories/'; 
	private $category  = [ "MCO1384", "MCO40433", "MCO1051", "MCO1132"];
	private $categoryRand  = 0;
	private $categoryData  = [];
	private $products      = [];	
	private $productList   = [];	

    /**
     * Lists all Products EndPoint Mercado Libre.
     * @return mixed
     */
    public function actionIndex()
    {

    	$this->categoryRand = array_rand($this->category);

        // Result is parsed JSON array
        $this->categoryData = Yii::$app->httpclient->get($this->endPoint.$this->category[$this->categoryRand]);

        foreach($this->categoryData["children_categories"] as $item)
        {

            $this->products[] = Yii::$app->httpclient->get("{$this->endPoint}{$item["id"]}");
        }        

        return $this->render('index', ['category' => $this->categoryData, 
        							   'products' => $this->products, 
        							   'listCart' => $this->actionList()]
        					);        
    }

    /**
     * Creates a new Product in shopping cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
     		
	    	$cart = \Yii::$app->request->post();
			$shoppingCart = new ShoppingCart();
			$shoppingCart->mercadolibre_id = $this->actionValidate($cart["mercadolibre_id"]);
			$shoppingCart->name = $this->actionValidate($cart["name"]);
			$shoppingCart->picture = $this->actionValidate($cart["picture"]);
			$shoppingCart->status = 0;

			$shoppingCart->load(\Yii::$app->request->post());

			if (!$shoppingCart->validate($cart)) {
				return $message = [
					'success' => $shoppingCart->errors,
				];
			}

			if($shoppingCart->insert()){
				$message = [					
					'success' => true,
					'process' => "Insert Ok",
				];
			}
     
            return $message;
        }            	
    }  

    public function actionList() 
    {
    	$this->productList = ShoppingCart::find()->all();
    	return $this->productList;
    } 

    public function actionValidate($param) 
    {
    	return (isset($param) ? $param : "");
    }

    /**
     * Deletes an existing product of ShoppingCart model.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {

        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;

			$this->findModel($_POST["id"])->delete();

			$message = [					
				'success' => true,
				'process' => "Delete Ok",
			];
     
            return $message;
        }            	
    }

	/**
	* Finds the Customer model based on its primary key value.
	* If the model is not found, a 404 HTTP exception will be thrown.
	* @param integer $id
	* @return shoppingCart the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($id)
    {
        if (($model = ShoppingCart::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}