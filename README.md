# WordPress
WordPress connector plugin for Data Dwell

## Setup
1. Install plugin
2. Under Settings -> Data Dwell add your domain and API key
3. Start using the plugin

## Usage

### Asset Search Simple
    DataDwell()->asset_search($string, $from, $size, $includes);

### Asset Search Advanced
    DataDwell()->asset_search($object, $from, $size, $includes);

### Asset Previews
    DataDwell()->asset_previews($asset_ids);

### Get All Metadata Fields
    DataDwell()->metadata_get_fields($parent_metafield_id);

### Get Metadata Field Details
    DataDwell()->metadata_get_details($metafield_id);

### Create Folder
    DataDwell()->folder_create($name, $parent_folder_id);

### Create Upload URL
    DataDwell()->upload_url($folder_id);