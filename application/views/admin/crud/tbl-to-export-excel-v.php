<table class="d-none" id="tbl-vendo-excel" border="1">
  <tr>
    <th scope="col">NAME</th>
    <th scope="col">DATE</th>
    <th scope="col">AMOUNT COLLECTED</th>
  </tr>
  <?php $total = 0; ?>
  <?php foreach($data as $row): ?>
    <tr>
      <td><?php echo strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name); ?></td>
      <td><?php echo $row->date_applied; ?></td>
      <td><?php echo $row->amount; ?></td>
    </tr>	
  <?php $total += floatval(str_replace(',', '', $row->amount)) ?>
  <?php endforeach; ?>
  <tr>
    <td></td>
    <td><strong>TOTAL:</strong></td>
    <td><?php echo number_format($total, 2); ?></td>
  </tr>

</table>