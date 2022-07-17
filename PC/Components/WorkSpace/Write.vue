<template>
    <div style="position: relative;height: 100%;">
        <iframe :src="address" style="width:100%;height: 100%;border: 0;"></iframe>
    </div>
</template>

<script>
    module.exports = {
        data:function() {
            return {
                address: ''
            }
        },
        mounted() {
            this.address = Write;
        }
    }
</script>

<style scoped>
    iframe {
        height: 100vh;
        border: 0;
    }
</style>