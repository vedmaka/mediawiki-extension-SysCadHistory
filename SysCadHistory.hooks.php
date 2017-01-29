<?php

class SysCadHistoryHooks {
    
    // Disable history tab for anonymous visitors
    public static function Universal( &$sktemplate, &$links ) {
        
        global $wgOut;
        
        if( !$wgOut->getUser() || $wgOut->getUser()->isAnon() ) {
            if( array_key_exists('history', $links['views']) ) {
                unset( $links['views']['history'] );
            }
        }
        
    }
    
    public static function MediaWikiPerformAction( $output, $article, $title, $user, $request, $wiki ) {
        
        if( !$user || $user->isAnon() ) {
            if( $request->getVal('action') == 'history' || $request->getVal('oldid') ) {
                $output->setPageTitle( wfMessage('syscadhistory-error-title')->plain() );
                $output->addHTML( wfMessage('syscadhistory-message-action-not-allowed')->plain() );
                return false;
            }
        }
        
    }
    
}