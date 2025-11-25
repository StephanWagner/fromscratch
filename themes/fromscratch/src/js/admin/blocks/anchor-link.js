const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;
const { __ } = wp.i18n;

wp.blocks.registerBlockType("fromscratch/anchor-link", {
    edit: ({ attributes, setAttributes }) => {
        return [
            wp.element.createElement(
                InspectorControls,
                {},
                wp.element.createElement(
                    PanelBody,
                    { title: __("Anchor Settings", "fromscratch") },
                    wp.element.createElement(TextControl, {
                        label: __("Anchor ID", "fromscratch"),
                        value: attributes.anchorId,
                        onChange: (value) => setAttributes({ anchorId: value }),
                    })
                )
            ),
            wp.element.createElement(
                "div",
                null,
                "Anchor ID: ",
                attributes.anchorId || "—"
            ),
        ];
    },
});
