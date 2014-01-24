<div id="block-error-chart">
	<br />
		
	<div id="error-chart-header" class="block-admin-subheading">
		<button type="button" style="float:right" name="error-chart-close"
			onclick="window.location='administration.php?error-chart=false';">
		CLOSE
		</button>
		<h4 style="margin:0px; padding:10px 0px 0px 0px;">Error Chart</h4>
	</div>
	
	<div class="content">
		<table>
			<tr>
				<th id="code" class="center">code:</th>
				<th id="level" class="center">level:</th>
				<th id="file" class="left">file:</th>
				<th id="desc" class="left">description:</th>
			</tr>
		
		
			<?php 
			
			//include error report script
			require_once("sites/scripts/error_report.php");
			
			//loop through all possible errors between 99 and 1000
			for($i=100; $i<1000; $i++) {
				//clear variables
				$code = null;
				$code_desc = null;
				$code_loc = null;
				$code_severity = null;
				
				//set variables
				$code = $i;
				$code_desc = code_desc($code);
				$code_loc = code_loc($code);
				$code_severity = code_severity($code);
				
				if($code_severity != null) {
					echo "<tr>";
						echo "<td class=\"center\">" . $code . "</td>";
						echo "<td class=\"center\">" . $code_severity . "</td>";
						echo "<td class=\"left\">" . $code_loc . "</td>";
						echo "<td class=\"left\">" . $code_desc . "</td>";
					echo "</tr>";
				}
			}
			
			?>
		
		</table>
		
		<p>
			Level 1 - reported to client, logged on server and IP blocked
			<br />
			Level 2 - reported to client and logged on server
			<br />
			Level 3 - logged on server only
			<br />
			Level 4 - reported to client only
			<br />
			Level 5 - not reported
		</p>
	</div>
</div>
