const { InspectorControls, useBlockProps } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;
const { __ } = wp.i18n;
const { Fragment } = wp.element;

wp.blocks.registerBlockType("fromscratch/anchor-link", {
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        
        return wp.element.createElement(
            Fragment,
            {},
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
                blockProps,
                "Anchor ID: ",
                attributes.anchorId || "—"
            )
        );
    },
    save: () => {
        return null; // Dynamic block, rendered via PHP
    },
});
