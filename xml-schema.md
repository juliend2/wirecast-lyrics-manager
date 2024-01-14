#

    document
        ...
        source_configuration
            source[factoryGUID, prettyname(string), unique_id(uuid), groupGUID, categories(int)]
                xml_tag[widget_settings(JSON([text=base64 data]))]
        assets
            asset[unique_id(uuid), media_type(int)]
        shots
            shot[unique_id(uuid)]
                event[event_type(int), unique_id(uuid)]
                    [event[...]]
