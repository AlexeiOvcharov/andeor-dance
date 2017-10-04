<?php

namespace AppBundle\Service;

use AppBundle\Entity\Users;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Mail
{
    use ContainerAwareTrait;

    const MAIL_FEEDBACK = '@App/Mail/feedback.html.twig';

    public function send($template, $email, $subject, array $data = [])
    {
        $container = $this->getContainer();
        $content = $container->get('twig')->render($template, $data);
        try {
            /** @var \Swift_Message $message */
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($container->getParameter('mailer_from'))
                ->setTo($email)
                ->setBody($content, 'text/html');

            $container->get('swiftmailer.mailer')->send($message);
        } catch (\Exception $e) {
            //next send
        }
    }

    /**
     * @return ContainerInterface
     */
    private function getContainer()
    {
        return $this->container;
    }


}