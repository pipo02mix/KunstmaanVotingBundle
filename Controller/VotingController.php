<?php

namespace Kunstmaan\VotingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Kunstmaan\VotingBundle\Event\Events;
use Kunstmaan\VotingBundle\Event\Facebook\FacebookLikeEvent;
use Kunstmaan\VotingBundle\Event\Facebook\FacebookSendEvent;
use Kunstmaan\VotingBundle\Event\LinkedIn\LinkedInShareEvent;

class VotingController extends Controller
{

    /**
     * @Route("/voting-facebooklike", name="voting_facebooklike")
     * @Template("KunstmaanVotingBundle:Facebook:like-callback")
     */
    public function facebookLikeAction(Request $request)
    {
        $response = $request->get('response');
        $value = $request->get('value');
        $this->get('event_dispatcher')->dispatch(Events::FACEBOOK_LIKE, new FacebookLikeEvent($this->getRequest(), $response, $value));
    }

    /**
     * @Route("/voting-facebooksend", name="voting_facebooksend")
     * @Template("KunstmaanVotingBundle:Facebook:send-callback")
     */
    public function facebookSendAction(Request $request)
    {
        $response = $request->get('response');
        $value = $request->get('value');
        $this->get('event_dispatcher')->dispatch(Events::FACEBOOK_SEND, new FacebookSendEvent($this->getRequest(), $response, $value));
    }

    /**
     * @Route("/voting-linkedinshare", name="voting_linkedinshare")
     * @Template("KunstmaanVotingBundle:LinkedIn:share-callback")
     */
    public function linkedInShareAction(Request $request)
    {
        $reference = $request->get('reference');
        $value = $request->get('value');
        $this->get('event_dispatcher')->dispatch(Events::LINKEDIN_SHARE, new LinkedInShareEvent($this->getRequest(), $reference, $value));
    }

}