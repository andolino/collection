<table class="d-none" id="tbl-internet-sales-excel" border="1">
  <tr>
    <th scope="col">No.</th>
    <th scope="col">DATE</th>
    <th scope="col">AMOUNT COLLECTED</th>
  </tr>
  <?php $i = 1; ?>
  <?php foreach($data as $row): ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row->date_applied; ?></td>
    <td><?php echo $row->amount; ?></td>
  </tr>	
  <?php $i++; ?>
  <?php $total += floatval(str_replace(',', '', $row->amount)); ?>
  <?php endforeach; ?>
  <tr>
    <td></td>
    <td><strong>TOTAL:</strong></td>
    <td><?php echo number_format($total, 2); ?></td>
  </tr>
</table>