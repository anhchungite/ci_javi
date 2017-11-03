<div class="row">
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box blue-bg">
         <i class="fa fa-newspaper-o"></i>
         <div class="count"><?php if(isset($countNews))echo $countNews?></div>
         <div class="title">Bài viết</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box brown-bg">
         <i class="fa fa-bars"></i>
         <div class="count"><?php if(isset($countCat))echo $countCat?></div>
         <div class="title">Danh mục</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->	
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box dark-bg">
         <i class="icon_documents_alt"></i>
         <div class="count"><?php if(isset($countPage))echo $countPage?></div>
         <div class="title">Trang</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box green-bg">
         <i class="fa fa-users"></i>
         <div class="count"><?php if(isset($countUser))echo $countUser?></div>
         <div class="title">User</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->
</div>
<!--/.row-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
<canvas id="myChart" width="auto" height="150">Trình duyệt của bạn không hỗ trợ</canvas>
<?php if(isset($arrCount)){
	$strDataPost 	= "";
	$strDataAccess 	= "";
	foreach ($arrCount as $key => $value){
		$strDataPost 	.= $value['num_post'].',';
		$strDataAccess 	.= $value['num_access'].',';
	}
}?>
<script>
var ctx = document.getElementById("myChart");
var data = {
	    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
	    datasets: [
	        {
	            label: "Số bài viết",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(75,192,192,0.4)",
	            borderColor: "rgba(75,192,192,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(75,192,192,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(75,192,192,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php echo $strDataPost?>],
	            spanGaps: false,
	        },
	        {
	            label: "Số lượt truy cập",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(240, 154, 5,0.4)",
	            borderColor: "rgba(240, 154, 5,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(240, 154, 5,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(240, 154, 5,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php echo $strDataAccess?>],
	            spanGaps: false,
	        },
	    ]
	};
var myChart = new Chart(ctx, {
    type: 'line',
    data:data,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
 <!-- <div class="row">
<div class="col-lg-12">
<section class="panel">
   <header class="panel-heading">
      THỐNG KÊ
   </header>
   <div class="panel-body">
   <div class="col-lg-3">
      <div class="btn-group add-btn">
         <button type="button" class="btn btn-default">Ngày</button>
         <button type="button" class="btn btn-default">Tuần</button>
         <button type="button" class="btn btn-default">Tháng</button>
         <button type="button" class="btn btn-default">Năm</button>
      </div>
   </div>
  <div class="col-lg-3">
      <select id="select_cat" class="form-control m-bot15" name="danhmuc" required="">
      							<option value="all">Tất cả người dùng</option>
      														<option value="56">Tin Tức Giải Trí</option>
      														<option value="67">Du Học Nhật Bản</option>
      													</select>
      												
      													</div>
      							  <table class="table table-striped table-advance table-hover">
      							   <tbody>
      								  <tr>
      									 <th>STT</th>
      									 <th>ID</th>
      									 <th>Tiêu đề</th>
      									 <th>Danh mục</th>
      									 <th>Trạng thái</th>
      									 <th>Lượt xem</th>
      								  </tr>
      								  <tr>
      									 <td class="col-lg-1"></td>
      									 <td class="col-lg-1"></td>
      									 <td class="col-lg-3"></td>
      									 <td class="col-lg-2"></td>
      									 <td class="col-lg-2"></td>
      									 <td class="col-lg-1"></td>
      								  </tr>
      							   </tbody>
      							</table>
      						</div>
                            </section>
                        </div>
                    </div> -->
</section>
</section>
<!--main content end-->