<?php 
		echo $this->Paginator->first('First');
                if($this->Paginator->hasPrev()){                 
                    echo $this->Paginator->prev(__('Previous'), array(), null, array('class' => 'prev disabled'));
                }
		echo $this->Paginator->numbers(array('separator' => '', 'modulus' => 5));
                if($this->Paginator->hasNext()){                
                    echo $this->Paginator->next(__('Next'), array(), null, array('class' => 'next disabled'));
                }
		echo $this->Paginator->last('Last');         
?>
<script type="text/javascript">
$('#ajxPage span a').on({
   click:function(evt){
        evt.preventDefault();
        //refresh_results( );
        
       	$('#ajxResults, #ajxResultsP').animate({opacity:0.5});

	// stop the previous call
	if (results_jqXHR) {
		results_jqXHR.abort( );
	}

	results_jqXHR = $.post(
		$(this).attr('href'),
		$('#SearchResultsForm').serialize( ),
		function (res) {
			return_data = $.parseJSON(res);
			update_content(false);
			results_jqXHR = false;
		}
	);        
   } 
});
</script>