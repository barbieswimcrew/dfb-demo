<?php

namespace AppBundle\Controller;

use Barbieswimcrew\Bundle\DynamicFormBundle\Structs\Rules\Rule;
use Barbieswimcrew\Bundle\DynamicFormBundle\Structs\Rules\RuleSet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class SimpleFormController extends Controller
{

    /**
     * @Route("/simple/radio", name="simple_radio")
     *
     * @param Request $request
     * @author Martin Schindler
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function radioFormAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('account', ChoiceType::class, array(
                'label' => 'Register account?',
                'choices' => array(
                    'yes' => 1,
                    'no' => 0,
                ),
                'data' => 1,
                'expanded' => true,
                'rules' => new RuleSet(array(
                    new Rule(1, array('password'), array()),
                    new Rule(0, array(), array('password'))
                ))
            ))
            ->add('password', TextType::class)
            ->getForm()
            ->handleRequest($request);

        return $this->render('@App/Form/Simple/radio.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
