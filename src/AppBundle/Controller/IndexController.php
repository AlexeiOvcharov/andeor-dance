<?php

namespace AppBundle\Controller;

use AppBundle\Form\Index\FeedbackForm;
use AppBundle\Service\Mail;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexController
 * @package AppBundle\Controller
 * @author Andrei Berezin <yago.spb@gmail.com>
 */
class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template("@App/Index/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(FeedbackForm::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $flashBag = $this->get('flash_bag');
            if ($this->feedback($form->getData())) {
                $flashBag->addSuccess('Сообщение отправлено');

                return $this->redirect($this->generateUrl('index'));
            } else {
                $flashBag->addError('Ошибка отправки сообщения');
            }
        }

        return [
            'form' => $form->createView()
        ];
    }

    private function feedback(array $formData)
    {
        try {
            foreach ($this->getParameter('admin_emails') as $email) {
                $this->get('mail')->send(
                    Mail::MAIL_FEEDBACK,
                    $email,
                    'Форма обратной связи',
                    [
                        'text' => $formData['text'],
                        'name' => $formData['name'],
                        'email' => $formData['email']
                    ]
                );
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
