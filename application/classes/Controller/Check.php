<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Check extends Controller {

    public function action_index()
    {
        $view = new View('check');
        $view->title = 'Check Page';

        $map = array(
            Kohana::PRODUCTION => 'PRODUCTION',
            Kohana::STAGING => 'STAGING',
            Kohana::TESTING => 'TESTING',
            Kohana::DEVELOPMENT => 'DEVELOPMENT'
        );
        $view->environment = array($map[Kohana::$environment], Kohana::$environment);

        $session = Session::instance();
        $visits = (int)$session->get('visits');
        $session->set('visits', ++$visits);
        $view->visits = $visits;

        if($this->request->method() == 'POST') {
            $post = Validation::factory($this->request->post());
            $post->rule('logentry_message', 'not_empty');
            if($post->check()) {
                Log::instance()->add(Log::INFO, sprintf('Info Logentry was sent: %s', $post['logentry_message']));
                Log::instance()->add(Log::ERROR, sprintf('Error logentry was sent: %s', $post['logentry_message']));
            }
        }
        echo $view->render();
    }
}
