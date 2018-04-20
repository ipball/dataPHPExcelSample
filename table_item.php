<?php
require 'config.php';
require 'pagination/Zebra_Pagination.php';
$pagination = new Zebra_Pagination();

$perpage = $_GET['perpage'];
$page = isset($_GET['page']) ? ((int)$_GET['page']) : 1;
$start = ($page-1) * $perpage;
$condition = "where 1=1 ";
$condition .= !empty($_GET['first_name']) ? "and sus_name like '%{$_GET['first_name']}%' " : "";
$condition .= !empty($_GET['last_name']) ? "and sus_surename like '%{$_GET['last_name']}%' " : "";
$condition .= !empty($_GET['age']) ? "and sus_age like '%{$_GET['age']}%' " : "";
$condition .= !empty($_GET['place']) ? "and sus_addr_tumbol like '%{$_GET['place']}%' " : "";
$sql = "select * from tb_case22 ";
$sql = $sql . $condition;
$sql_filter = $sql . "limit {$start},{$perpage} ";

$query = $connect->query($sql_filter);
$count = $query->num_rows;
$query_count = $connect->query($sql);
$count_all = $query_count->num_rows;
$total_page = ceil($count_all/$perpage);
$last_page = $perpage - ($count_all%$perpage);
$last_page = ($last_page==$perpage) ? 0 : $last_page;

$count_page = ($page==$total_page) ? ($page*$perpage)-$last_page : ($page*$perpage);

$pagination->records($count_all);
$pagination->records_per_page($perpage);
$pagination->labels('ก่อนหน้า', 'ถัดไป');
$pagination->base_url('#','');
?>
<div class="col-md-12">
	<?php if($count > 0){ ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ลำดับ</th>
				<th>ชื่อ</th>
				<th>นามสกุล</th>
				<th>อายุ</th>
				<th>สถานที่</th>
				
			</tr>
		</thead>
		<tbody>
			<?php $i=1; while ($result =$query->fetch_object()) { ?>
			<tr>
				<td><?php echo ($i+$start);?></td>
				<td><?php echo $result->sus_name;?></td>
				<td><?php echo $result->sus_surename;?></td>
				<td><?php echo $result->sus_age;?></td>
				<td><?php echo $result->sus_addr_tumbol;?></td>
				
			</tr>
			<?php $i++;} ?>
		</tbody>
	</table>
	<div class="pull-left"> 
		รายการที่ <?php echo number_format(($start+1)) ?> ถึง <?php echo number_format($count_page); ?> จากทั้งหมด <?php echo number_format($count_all); ?>
	</div>
	<div class="pull-right">
		<?php $pagination->render(); ?>
	</div>
	<?php } else { ?>
	<div class="alert alert-danger" role="alert">ไม่พบข้อมูลที่ต้องการค้นหา</div>
	<?php } ?>
</div>