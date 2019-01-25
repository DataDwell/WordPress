<?php 

?>
<h2><?php echo __( 'Data Dwell Plugin Demo - Assets and Previews', 'datadwell' ); ?></h2>
<?php
// Fetch assets and display thumbnails
$asset_container = DataDwell()->asset_search('*');
$previews = DataDwell()->asset_previews($asset_container);
foreach($previews as $preview)
{
    if($preview->url->image->thumbnail_small)
    {
        ?><img src="<?php echo $preview->url->image->thumbnail_small; ?>" style="border: 4px dotted #b60000; padding: 5px; margin: 5px;" /><?php
    }
}

?>
<h2><?php echo __( 'Data Dwell Plugin Demo - Metadata and Fields', 'datadwell' ); ?></h2>
<?php
// Fetch all metafields
$metafields = DataDwell()->metadata_get_fields();
?>
<table>
    <thead>
        <tr>
            <td><?php echo __( 'Id', 'datadwell' ); ?></td>
            <td><?php echo __( 'Name', 'datadwell' ); ?></td>
        </tr>
    </thead>
    <tbody><?php
foreach($metafields as $metafield)
{
    ?>
    <tr>
        <td><?php echo $metafield->id; ?></td>
        <td><?php echo $metafield->name; ?></td>
    </tr><?php
}
?>
    </tbody>
</table>