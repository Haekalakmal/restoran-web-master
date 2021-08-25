<!-- jquery 3.3.1 -->
<script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="<?php echo base_url() ?>assets/concept-master/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- main js -->
<script src="<?php echo base_url() ?>assets/concept-master/assets/libs/js/main-js.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
	$(function(){
		$("body").on("click",".link-ask",function(){
            let title = $(this).attr("data-title");
            let message = $(this).attr("data-message");
            let href = $(this).attr("data-href");
            Swal.fire({
              title: title,
              text: message,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = href;
              }
            })
        });
        /*data-href="'.url('tps_castrol/send_to_beacukai/'.$row->castrol_header_id).'" data-title="Are you sure?" data-message="data will be send to beacukai" class="link-ask*/
  		$("body").on("click",".link-ask-reason",function(){
            let title = $(this).attr("data-title");
            let message = $(this).attr("data-message");
            let href = $(this).attr("data-href");

            Swal.fire({
			    title: title,
			    text: message,
			    icon: 'info',
              	input: 'text',
			    showCancelButton: true        
			}).then((result) => {
			    if (result.value) {
					let inputValue = result.value;

				  	if (inputValue === null) return false;
				  
				  	if (inputValue === "") {
				    	swal.showInputError("masukan inputanya");
				    	return false
				  	}
			  		href = href + "/" + inputValue.replaceAll(" ", "_");
			  		console.log(href);
	          window.location.href = href;
			    }
			});
        });
	})
</script>