<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Feeds, View, Mail;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {
        $feed = Feeds::make('http://prncloud.com/xml/rss_generico.php?clienteNews=277&paisNews=8');
        
        $feeds = $feed->get_items();

        $items = [];

        foreach($feeds as $f)
        {   
            $data = $f->data;

            $item['title'] = $data['child']['']['title'][0]['data'];
            $item['link'] = $data['child']['']['link'][0]['data'];
            $item['description'] = $data['child']['']['description'][0]["data"];

            $pattern = "/\d{4}\-\d{2}\-\d{2}/";
                
            if (preg_match($pattern, $data['child']['']['description'][0]["data"], $matches)) 
            {
               $item['date'] = $matches[0];
            }

            $category = [];

            foreach($data['child']['']['category'] as $c)
            {
                $category[] = $c['data'];
            }

            $item['categories'] = $category;

            $items[] = $item;
        }

        usort($items, function($a, $b){
            $name = strcmp($a['date'], $b['date']);
            
            if($name === 0)
            {
                return strcmp($a['title'], $b['title']);
            }
            return $name;
        });

        $data = array(
            'title'     => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items'     => $items,
        );

        return View::make('newsletter/list', $data);
    }

    public function enviar(Request $r)
    {
        $links = $r->input('news');
        $email = $r->input('email');

        $feed = Feeds::make('http://prncloud.com/xml/rss_generico.php?clienteNews=277&paisNews=8');
        
        $feeds = $feed->get_items();

        $items = [];

        foreach($feeds as $f)
        {   
            $data = $f->data;
            $item['link'] = $data['child']['']['link'][0]['data'];
            
            if(in_array($item['link'], $links))
            {   
                $item['title'] = $data['child']['']['title'][0]['data'];
                $item['link'] = $data['child']['']['link'][0]['data'];
                $item['description'] = $data['child']['']['description'][0]["data"];

                $pattern = "/\d{4}\-\d{2}\-\d{2}/";
                    
                if (preg_match($pattern, $data['child']['']['description'][0]["data"], $matches)) 
                {
                   $item['date'] = $matches[0];
                }

                $items[] = $item;
            }
        }
        
        Mail::send('newsletter.email', ['title' => 'PR Newswire', 'items' => $items], function ($message) use (&$email)
        {   
            $message->from('no-reply@teste.com', 'PR Newswire - Newsletter');
            $message->to($email);
        });

        return redirect('newsletter');

    }

}
