<?php

// Fetch assets and display thumbnails
$asset_container = DataDwell()->asset_search('*');
$previews = DataDwell()->asset_previews($asset_container);
if(empty($previews->error)) :
    echo '<h2>'.__( 'Data Dwell Plugin Demo - Assets and Previews', 'datadwell' ).'</h2>';
	foreach ( $previews as $preview ) {
		if ( $preview->url->image->thumbnail_small ) {
			?><img src="<?php echo $preview->url->image->thumbnail_small; ?>"
                   style="border: 4px dotted #b60000; padding: 5px; margin: 5px;" /><?php
		}
	}
else:
    echo __((string)$previews->error, 'datadwell' ).'<br />';
endif;

?>


<?php
/* DEMO */
//print 'All folders -3003';
//$folders = DataDwell()->get_folders(-3003);
//var_dump($folders);

//print 'Folder Details - 70';
//$folder_details = DataDwell()->get_folder_details(70);
//var_dump($folder_details);


/*
print 'Asset search';
$includes = ['include_iptc' => false, 'include_metadata' => true, 'include_tags' => true];
$additional_params = ['folder_id' => 427, 'tag_id' => 39, 'filter' => ['date_created' => ['from' => 1544193649]]];
$asset_container = DataDwell()->asset_search('', 0, 20, $includes, $additional_params);
var_dump($asset_container);
$previews = DataDwell()->asset_previews($asset_container);
var_dump($previews);
*/

//print 'Tags search';
//$tag = DataDwell()->tags_search("00123595");
//var_dump($tag);


/* END DEMO */

?>

<?php
// Fetch all metafields
$metafields = DataDwell()->metadata_get_fields();
if(empty($metafields->error)) :
?>
    <h2><?php echo __( 'Data Dwell Plugin Demo - Metadata and Fields', 'datadwell' ); ?></h2>
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
                /*if(!empty($metafield->id)){
	                $metadetails = DataDwell()->metadata_get_details($metafield->id);
	                print '<pre>';
	                print_r($metadetails);
                }*/
                ?>
                <tr>
                    <td><?php echo $metafield->id; ?></td>
                    <td><?php echo $metafield->name; ?></td>
                </tr><?php
            }
            ?>
        </tbody>
    </table>
<?php
else:
    echo __((string)$metafields->error, 'datadwell' ).'<br />';
endif;
?>