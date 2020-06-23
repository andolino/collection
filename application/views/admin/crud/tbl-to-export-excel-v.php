<table class="d-none" id="tbl-vendo-excel" border="1">
  <tr>
    <th scope="col">NAME</th>
    <th scope="col">DATE</th>
    <th scope="col">AMOUNT COLLECTED</th>
  </tr>
  <?php foreach($data as $row): ?>
    <tr>
      <td><?php echo strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name); ?></td>
      <td><?php echo $row->date_applied; ?></td>
      <td><?php echo $row->amount; ?></td>
    </tr>	
  <?php endforeach; ?>

</table>