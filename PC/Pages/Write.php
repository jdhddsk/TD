<?php $Core = new GCZ_Core; ?>
<main class="gcz-pc-main">
    <div id="gcz-pc-write" class="gcz-width">
        <h1>撰写新文章</h1>
        <form>
        <p>
            <t-input v-model="TDWriteTitle" name="title" size="large" placeholder="请输入文章标题"></t-input>
        </p>
        <?php wp_editor('', 'gcz-content', $settings); ?>
        <p style="display:flex;justify-content: space-between;">
            <t-button :loading="TDWriteLoading" @click="TDWriteAction()">提交</t-button>
            <t-select multiple style="width:auto" v-model="value2" placeholder="请选择一个文章分类">
                <t-option v-for="item in TDCategory" :value="item.name" :label="item.name" :key="item.term_id"></t-option>
            </t-select>
        </p>
        </form>
    </div>
</main>
<style>
    #td-header {
        display: none;
    }
</style>
<?php if ($Core->isMobile()) { ?>
    <script src="<?php echo GCZ_URI; ?>/Core/Script/Mobile/Write.js"></script>
<?php } else { ?>
    <script src="<?php echo GCZ_URI; ?>/Core/Script/PC/Write.js"></script>
<?php } ?>