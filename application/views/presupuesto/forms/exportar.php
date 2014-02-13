<div>
	<button id="expo" class="btn btn-primary" id="expo" style="margin-top:20px" onClick="exportExcel()">Exportar a Excel</button>
</div>
<script type="text/javascript">

function exportExcel()
{
	document.forms[0].method='POST';
	document.forms[0].action= CI.site_url + "/presupuesto/csvexport/exp_presupuesto";
	document.forms[0].target='_blank';
	document.forms[0].submit();
}

</script>