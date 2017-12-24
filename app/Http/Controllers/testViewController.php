<?php
/**
 * testViewController.php
 *
 * Author: Lomo
 * Date: 2017-12
 * Email: lomo@lomo.space
 * URL: http://lomo.space
 *
 * Description:
 *
 */

    namespace  App\Http\Controllers;

    use App\Member;
    use app\testViewModel;

    class testViewController extends Controller {

//        public $x;
//
//        public function __construct()
//        {
//            $this->x = 123;
//        }

        public function testViews() {
//            return Member::getMember();

//            return view('test2', [
//                'other' => Member::getMember()
//            ]);

            return view('testView', [
                'name' => 'Lomo',
                'age' => '20',
                'other' => Member::getMember()
            ]);
        }
    }