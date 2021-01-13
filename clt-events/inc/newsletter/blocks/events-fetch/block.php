<?php
/*
 * Name: CES events (auto import)
 * Section: content
 * Description: event information and link
 *
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
    'start_date' => (new DateTime())->modify('first day of this month')->format('Y-m-d'),
    'end_date' => (new DateTime())->modify('last day of this month')->format('Y-m-d'),
    'last_updated' => 'never',
    'json' => null,
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 5,
    'block_padding_bottom' => 5,
    'block_background' => '#ffffff',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => 16,
    'font_color' => '#000'
);

//$default_options['html'] = '';
$options = array_merge($default_options, $options);

?>

<?php
    $ces_api = CES_API::get_instance();
    $events = $ces_api->get_events([
        'start_date' => $options['start_date'],
        'end_date' => $options['end_date']
    ]);
?>

<style>
    .html-td {
        font-family: <?php echo $options['font_family']?>;
    }
</style>
<?php
// Templating functions for this block
function clt_tnp_block_events_fetch_render_th($event) { ?>
    <th style="font-size: 18px; font-weight: bold; padding-top: 15px;">
        <?php
        try {
            echo (new DateTime($event['start_date']))->format('m/d');
        } catch(Exception $e) {
            echo '';
        }
        ?>
        -
        <?php
        try {
            echo (new DateTime($event['end_date']))->format('m/d');
        } catch(Exception $e) {
            echo '';
        }
        ?>
    </th>
<?php }

function clt_tnp_block_events_fetch_render_cell($event, $side_border) { ?>
    <td width="50%" align="center" inline-class="html-td" >
        <div style="<?php echo ($side_border) ? "border-right: 1px solid #dddddd; border-right-width: 1px; padding: 15px; margin-bottom: 20px;" : "" ?>">
            <p style="font-size: 16px; line-height: 1.5; color: #0e5080;
            font-weight: 700; min-height: 2em; margin-top: 0;">
                <?php echo esc_html( $event['title'] ); ?>
            </p>
            <p style="font-size: 16px; line-height: 1;">
                <?php if( array_key_exists('delivery_styles', $event) && is_array($event['delivery_styles']) ): ?>
                    <?php echo esc_html( $event['delivery_styles'][0]['title'] ); ?>
                <?php endif; ?>
                <?php if(count($event['delivery_styles']) > 1): ?>
                    <?php for($j = 1; $j < $event['delivery_styles']; $j++): ?>
                        or <?php echo esc_html( $event['delivery_styles'][$j]['title'] ); ?>
                    <?php endfor; ?>
                <?php endif; ?>
            </p>
            <p>
                <a href=<?php echo CES_API::link_to_ces_event($event['id']);  ?> target="_blank">
                    Register or get information
                </a>
            </p>
        </div>
    </td>
<?php }
?>
<?php // Output the table structure ?>
<table width="100%" cellpadding="0" align="center" cellspacing="0">
    <?php $ct = count($events) ?>
    <?php for ($i=0; $i < $ct ; $i += 2): ?>
    <?php $second_safe = ($i + 1) < $ct; ?>
        
    <tr style="margin-bottom: 0;">
        <?php clt_tnp_block_events_fetch_render_th($events[$i]); ?>
        <?php if ($second_safe): ?>
        <?php clt_tnp_block_events_fetch_render_th($events[$i + 1]); ?>
        <?php endif; ?>
    </tr>
    <tr style="border-bottom: 1px solid #dddddd;">
        <?php clt_tnp_block_events_fetch_render_cell($events[$i], true); ?>
        <?php if($second_safe): ?>
        <?php clt_tnp_block_events_fetch_render_cell($events[$i + 1], false); ?>
        <?php endif; ?>
    </tr>
    <?php endfor; ?>
</table>


