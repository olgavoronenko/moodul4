(function (wp) {
  const { registerPlugin } = wp.plugins;
  const { PluginDocumentSettingPanel } = wp.editPost;
  const { TextControl, SelectControl } = wp.components;
  const { createElement } = wp.element;
  const { useSelect, useDispatch } = wp.data;

  const fields = [
    {
      key: "nurr_cat_age",
      label: "Vanus",
      type: "text",
      placeholder: "Näiteks: 2 aastat",
    },
    {
      key: "nurr_cat_gender",
      label: "Sugu",
      type: "select",
      options: [
        { label: "Vali...", value: "" },
        { label: "Isane", value: "male" },
        { label: "Emane", value: "female" },
      ],
    },
    {
      key: "nurr_cat_color",
      label: "Värv",
      type: "text",
      placeholder: "Näiteks: Must-valge",
    },
    {
      key: "nurr_cat_personality",
      label: "Iseloom",
      type: "select",
      options: [
        { label: "Vali...", value: "" },
        { label: "Mänguline", value: "playful" },
        { label: "Rahulik", value: "calm" },
        { label: "Uudishimulik", value: "curious" },
      ],
    },
  ];

  function CatDetailsPanel() {
    const meta = useSelect((select) => select("core/editor").getEditedPostAttribute("meta") || [], []);
    const { editPost } = useDispatch("core/editor");

    const updateMeta = (key, value) => {
      editPost({
        meta: {
          ...meta,
          [key]: value,
        },
      });
    };

    return createElement(
      PluginDocumentSettingPanel,
      {
        name: "nurr-cat-details",
        title: "Kassi andmed",
        className: "nurr-cat-details-panel",
      },
      fields.map((field) => {
        const value = meta[field.key] || "";

        if (field.type === "select") {
          return createElement(SelectControl, {
            key: field.key,
            label: field.label,
            value,
            options: field.options,
            onChange: (nextValue) => updateMeta(field.key, nextValue),
          });
        }

        return createElement(TextControl, {
          key: field.key,
          label: field.label,
          value,
          placeholder: field.placeholder,
          onChange: (nextValue) => updateMeta(field.key, nextValue),
        });
      })
    );
  }

  registerPlugin("nurr-cat-details", {
    render: CatDetailsPanel,
  });
})(window.wp);
