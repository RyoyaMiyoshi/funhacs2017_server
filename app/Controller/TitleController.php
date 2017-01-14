<?php

//CakePHPに用意されているライブラリをロードする。
//CakePHPではさまざまな機能が用意されているので、それらを利用する場合にApp:usesを使う。
//書き方はApp::uses( クラス名 , パッケージ名 );
//AppControllerを継承するためにControllerパッケージを読み込む

App::uses('AppController', 'Controller');
App::uses('Xml', 'Utility');

class TitleController extends AppController {    //AppControllerを継承して使う

    public function gettitle() {
        $this->autoRender = false;
        $message = $_GET['message'];
        $xml_title = Xml::toArray(Xml::build("https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?applicationId=1053236563703144697&isbn=".$message."&format=xml"));
        //9784088801711
        $title = $xml_title["root"]["Items"]["Item"]["title"];
        $image = $xml_title["root"]["Items"]["Item"]["largeImageUrl"];
        header("Content-Type: text/html; charset=UTF-8");
        echo $title;
        echo ",";
        echo $image;
        echo nl2br("\n");
    }
}
