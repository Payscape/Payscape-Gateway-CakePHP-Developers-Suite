<?php  

class PaginationHelper extends HtmlHelper 
{ 
     
    function paginate( $link, $page, $total, $show=5, $skip='&hellip;' ) 
    { 
        /* 
            $link    string of what link is to be (utilizes $html->link helper)... page numbers will be appended to its end 
            $page    int current page you're on 
            $total    int total number of pages 
            $show    int how many page numbers / "skips" to show between first and last numbers 
            $skip    string text to be displayed for "skips"... inside <span> 
        */ 

        // Get out early if there's no total pages 
        if ( $total < 1 ) return false; 

        // Init 
        if ( $show < 1 ) $show = 1;                        // make sure you're showing at least 1 
        $show_mid = ceil( $show / 2 );                    // find the midpoint of the shown page numbers / skips
        $skip = '<span class="skip">'.$skip.'</span>';    // add spans around skip text 
        $out = "\n"; 

        // Figure out start point for In-between numbers 
        if ( $page <= $show_mid ) $start = 2; 
        elseif ( $page > ($total-$show) ) $start = $total - $show; 
        else $start = $page - $show_mid + 1; 

        // Previous link 
        $out .= ( ($page-1) > 0 ) 
                    ? $this->link( 'Prev', $link.($page-1), array('title'=>'View the previous index page', 'class'=>'prev') )  
                    : '<span class="prev">Prev</span>'; 
        $out .= "\n"; 

        // First number 
        $out .= ( $page == 1 ) 
                    ? '<span class="current">1</span>' 
                    : $this->link( '1', $link.'1', array('title'=>'View index page 1') ); 
        $out .= "\n"; 

        // In-between numbers 
        for ( $i=0; $i<( ($total<$show+2) ? $total-2 : $show ); $i++ ) 
        { 
            // First in-between number... 
            if ( $i == 0 ) 
            { 
                $out .= ( $start == 2 )  
                            ? ( $page == 2 ) 
                                ? '<span class="current">2</span>' 
                                : $this->link( '2', $link.'2', array('title'=>'View index page 2') ) 
                            : $skip; 
            } 

            // Last in-between number... 
            elseif ( $i == ($show-1) ) 
            { 
                $out .= ( $start >= ($total-$show) )  
                            ? ( $page == ($total-1) ) 
                                ? '<span class="current">'.($total-1).'</span>' 
                                : $this->link( ($total-1), $link.($total-1), array('title'=>'View index page '.($total-1)) ) 
                            : $skip; 
            } 

            // Else... 
            else  
            { 
                $out .= ( $page == ($start+$i) ) 
                            ? '<span class="current">'.($start+$i).'</span>' 
                            : $this->link( ($start+$i), $link.($start+$i), array('title'=>'View index page '.($start+$i)) ); 
            } 

            $out .= "\n"; 
        } 

        // Last number 
        if ( $total > 1 ) 
        { 
            $out .= ( $page == $total ) 
                        ? '<span class="current">'.$total.'</span>' 
                        : $this->link( $total, $link.$total, array('title'=>'View index page '.$total) ); 
            $out .= "\n"; 
        } 

        // Next link 
        $out .= ( ($page+1) <= $total ) 
                    ? $this->link( 'Next', $link.($page+1), array('title'=>'View the next index page', 'class'=>'next') ) 
                    : '<span class="next">Next</span>'; 
        $out .= "\n"; 

        // Return 
        return $out; 
    } 

} 
?>