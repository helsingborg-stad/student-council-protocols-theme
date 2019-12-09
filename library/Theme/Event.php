<?php
namespace Elevroden\Theme;

class Event
{
    public function __construct()
    {
        add_filter('acf/load_field/name=archive_event_post_style', array($this, 'eventArchiveTemplate'), 10, 3);
        add_filter('archive_equal_container', array($this, 'setEqualContainer'), 10, 3);
    }

    public function setEqualContainer($equalContainer, $postType, $template)
    {
        if ($postType == 'event') {
            return true;
        }

        return $equalContainer;
    }

    public function eventArchiveTemplate($field)
    {
        $field['choices']['kultur-event'] = 'Kulturkort Event';

        return $field;
    }
}
