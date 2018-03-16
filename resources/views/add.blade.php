
<div class="content">
				<div class="am-g">
					<!-- Row start -->
						<div class="am-u-sm-12">
							<div class="card-box">
								
								
								<form action="{{asset('img/insert')}}" class="am-form" method="post" data-am-validator enctype="multipart/form-data">
								  <fieldset>
								   {{csrf_field()}}
								    <div class="am-form-group">
								      <label >文件上传:</label>
								      <input type="file"  name="pic"  />
								    </div>
								    <button class="am-btn am-btn-secondary" type="submit">提交</button>
								  </fieldset>
								</form>
								
								
							</div>
						</div>
					<!-- Row end -->
				</div>
			
			
			
			
			</div>
