<template>
    <div>
        <div class="ckeditor"><textarea :id="id" :value="value"></textarea></div>
    </div>
</template>

<script>
export default {
    props: {
      value: {
        type: String
      },
      id: {
        type: String,
        default: 'editor'
      },
      width: {
        type: String,
        default: '595px'
      },
      height: {
        type: String,
        default: '400px',
      },
      toolbar: {
        type: Array,
        
      },
      language: {
        type: String,
        default: 'en'
      },
      extraplugins: {
        type: String,
        default: ''
      }
	},
    beforeUpdate () {
        const ckeditorId = this.id
        if (this.value !== CKEDITOR.instances[ckeditorId].getData()) {
            CKEDITOR.instances[ckeditorId].setData(this.value)
        }
	},
	mounted () {
        const ckeditorId = this.id
        const ckeditorConfig = {
            toolbar: this.toolbar,
            language: this.language,
            height: this.height,
            width: this.width,
            extraPlugins: this.extraplugins,
            removePlugins: 'elementspath',
            fullPage: false,
            resize_enabled: false,
            div_wrapTable: true,
            removePlugins: 'resize,autogrow,save,maximize,flash,about'
        }

        CKEDITOR.replace(ckeditorId, ckeditorConfig);

        let vueObj = this;

        CKEDITOR.on('instanceReady', function(){ 
           CKEDITOR.instances[ckeditorId].setData(this.value)
            CKEDITOR.instances[ckeditorId].on('change', () => {
                let ckeditorData = CKEDITOR.instances[ckeditorId].getData()
                if (ckeditorData !== this.value) {
                    vueObj.$emit('input', ckeditorData);
                }
            }); 
        });         
	},
	destroyed () {
      const ckeditorId = this.id
      if (CKEDITOR.instances[ckeditorId]) {
        CKEDITOR.instances[ckeditorId].destroy()
      }
    }
}
</script>