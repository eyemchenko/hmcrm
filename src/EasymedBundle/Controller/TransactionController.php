<?php

namespace EasymedBundle\Controller;

use EasymedBundle\Entity\Transaction;
use EasymedBundle\Form\Type\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TransactionController.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/transaction")
 */
class TransactionController extends Controller
{
    /**
     * Returns list of transactions.
     *
     * @Route("/list", name="transaction_index")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $transactions = $this->getDoctrine()
                             ->getRepository('EasymedBundle:Transaction')
                             ->findAll();

        return [
            'transactions' => $transactions,
        ];
    }

    /**
     * Adds transaction.
     *
     * @Route("/add", name="transaction_add")
     * @Template()
     *
     * @return []
     */
    public function addAction(Request $request)
    {
        $transaction = new Transaction();

        $form = $this->createForm(new TransactionType(), $transaction);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transaction);
            $em->flush();

            return $this->redirect($this->generateUrl('transaction_index'));
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
