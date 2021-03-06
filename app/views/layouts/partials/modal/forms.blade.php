@if (! Auth::check())
<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="tab-content">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<ul class="nav nav-tabs">
						<li id="login-tab-link" class="active"><a href="#login-tab" data-toggle="tab">Login</a></li>
						<li id="signup-tab-link"><a href="#signup-tab" data-toggle="tab">Sign Up</a></li>
					</ul>
					<div class="tab-pane active" id="login-tab">
						DERP
					</div>
					<div class="tab-pane text-center" id="signup-tab">
						<div class="row">
							<div class="col-sm-6">
								<p id="startup">
									X <br/>
									I’m a startup looking for talent
								</p>
								<p>This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print.</p>
							</div>
							<div class="col-sm-6">
								<p id="talent">
								Y <br/>
								I’m talent looking for a startup</p>
								<p>This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print. This text is meant to be treated as fine print.</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<input id="agree" type="checkbox" value="agree"/> I agree to the Terms of Use and am ready to get started.<br/>
								<button class="btn btn-primary">LinkedIn</button><br/>
								<a href="{{ route('register_path') }}">Or sign up with email instead</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {
		// Activate the signup tab
		$('#signup-link').on('click', function(event) {
			event.preventDefault();
			$('#login-tab, #login-tab-link').removeClass('active');
			$('#signup-tab, #signup-tab-link').addClass('active');
			$('#login-modal').modal();
		});
		// Activate the login tab
		$('#login-link').on('click', function(event) {
			event.preventDefault();
			$('#login-tab, #login-tab-link').addClass('active');
			$('#signup-tab, #signup-tab-link').removeClass('active');
			$('#login-modal').modal();
		});
	});
</script>
@endif
