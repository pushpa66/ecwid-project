<?php

namespace AppBundle\Controller;

use AppBundle\Structs\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('views/index', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/items", name="items")
     */
    public function viewItems(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.ecwid.com/api/v3/13039133/products?token=secret_dbZcq5Gxhcg8VfaMF7aGrxpp6qsFjnYp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: f294b327-7356-2762-2ce0-51d7ef19a67e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
        }

        $items = array();
        foreach ($response['items'] as $item){
            $product = new Product();
            $product->setName($item['name']);
            $product->setPrice($item['price']);
            $product->setImage($item['thumbnailUrl']);
            foreach ($item['attributes'] as $attr){
                if($attr['name'] == "Store ID"){
                    $product->setAliexpressId($attr['value']);
                }
            }
            $items[] = $product;

        }
        return $this->render('pages/items.html.twig', array(
            'products'=>$items
        ));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchPage(Request $request){
        return $this->render('pages/search_page.html.twig', array(
            'search' => false
        ));
//        return $this->render('pages/cart.html.twig');
    }

    /**
     * @Route("/api/search", name="apiSearch")
     */
    public function searchByProductID(Request $request){

        $searchKey = $request->get('searchKey');
        $response = array('status' => $searchKey, 'search' => true);

        return new JsonResponse($response);
    }
}

