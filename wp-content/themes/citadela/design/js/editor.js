const { registerPlugin } = wp.plugins;
const { PluginDocumentSettingPanel } = wp.editPost;
const { __ } = wp.i18n;
const { withSelect, withDispatch } = wp.data;
const { CheckboxControl } = wp.components;

let PageSettingsPanel = ( props ) => (
    <>
    <CheckboxControl
        label={ __( 'Hide page title section', 'citadela' ) }
        checked={ props.hide_page_title }
        onChange={ ( value ) => { props.onChange( value, '_citadela_hide_page_title' ) } }
    />
    { props.hide_page_title && <CheckboxControl
        label={ __( 'Remove space under header', 'citadela' ) }
        checked={ props.remove_header_space }
        onChange={ ( value ) => { props.onChange( value, '_citadela_remove_header_space' ) } }
    /> }
    </>
);

PageSettingsPanel = withSelect(
    ( select ) => {
        return {
            hide_page_title: wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )['_citadela_hide_page_title'] == '1',
            remove_header_space: wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )['_citadela_remove_header_space'] == '1'
        }
    }
) (PageSettingsPanel);

PageSettingsPanel = withDispatch(
    ( dispatch ) => {
        return {
            onChange: ( value, metaKey ) => {
                let meta = {};
                meta[ metaKey ] = value ? '1' : '0';

                dispatch( 'core/editor' ).editPost( {
                    meta: meta
                } );

                if ( metaKey == '_citadela_hide_page_title' && !value ) {
                    dispatch( 'core/editor' ).editPost( {
                        meta: { '_citadela_remove_header_space': '0' }
                    } );
                }
            }
        }
    }
) (PageSettingsPanel);

registerPlugin( 'citadela-page-settings-panel', {
    render: () => {
        if ( ! [ 'page', 'special_page' ].includes( wp.data.select("core/editor").getCurrentPostType() ) ) {
            return null;
        }

        return (
            <PluginDocumentSettingPanel
                name="ctdl-page-settings-panel"
                title={ __( 'Citadela Page Settings', 'citadela' ) }
            >
                <PageSettingsPanel />
            </PluginDocumentSettingPanel>
        )
    },
    icon: ''
} );