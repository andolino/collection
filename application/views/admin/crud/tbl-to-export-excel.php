<table class="d-none" id="tbl-monthly-bills-excel" border="1">
  <?php if ($lgu_id != ''): ?>
    <tr>
      <td>NAME: <?php echo !empty($data) ? strtoupper($data[0]->last_name . ', ' . $data[0]->first_name . ' ' . $data[0]->middle_name) : ''; ?></td>
      <td>ACTIVE: <?php echo !empty($data) ? $data[0]->transaction_date : ''; ?></td>
    </tr>
    <tr>
      <td>MONTH</td>
      <td>DATE</td>
      <td>PLAN</td>
      <td>AMOUNT</td>
    </tr>
    <?php $total=0; ?>
    <?php foreach($data as $row): ?>
      <tr>
        <td><?php echo $row->month; ?></td>
        <td><?php echo $row->date_applied; ?></td>
        <td><?php echo $row->plan; ?></td>
        <td><?php echo $row->amount; ?></td>
      </tr>	
    <?php $total += floatval(str_replace(',', '', $row->amount)) ?>
    <?php endforeach; ?>
    <tr>
      <td></td>
      <td></td>
      <td><strong>TOTAL:</strong></td>
      <td><?php echo number_format($total, 2); ?></td>
    </tr>
    <?php else: ?>
    <tr>
      <td>NAME</td>
      <td>MONTH</td>
      <td>DATE</td>
      <td>PLAN</td>
      <td>AMOUNT</td>
    </tr>
    <?php $total=0; ?>
    <?php foreach($data as $row): ?>
      <tr>
        <td><?php echo strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name); ?></td>
        <td><?php echo $row->month; ?></td>
        <td><?php echo $row->date_applied; ?></td>
        <td><?php echo $row->plan; ?></td>
        <td><?php echo $row->amount; ?></td>
      </tr>	
      <?php $total += floatval(str_replace(',', '', $row->amount)) ?>
    <?php endforeach; ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td><strong>TOTAL:</strong></td>
      <td><?php echo number_format($total, 2); ?></td>
    </tr>
  <?php endif; ?>

</table>