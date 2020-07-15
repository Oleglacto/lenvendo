<template>
    <div style="width: 100%;">
        <el-header>
            <span>Bookmarks</span>
            <div class="buttons">
                <el-button @click="showBookmarkForm">Add bookmark</el-button>
            </div>
        </el-header>
        <bookmark-form
            :bookmark-form-visible="bookmarkFormVisible"
            @bookmarkFormClosed="bookmarkFormVisible = false"
        ></bookmark-form>
    </div>
</template>

<script>
    import BookmarkForm from "./BookmarkForm";
    import { mapActions, mapState } from 'vuex';
    export default {
        name: 'Bookmarks',
        components: {
            BookmarkForm
        },
        data() {
            return {
                bookmarkFormVisible: false,
                roomFormAction: "",
            };
        },
        methods: {
            ...mapActions([

            ]),
            showBookmarkForm() {
                this.bookmarkFormVisible = true;
            },
        },
        computed: {

        }
    }
</script>

<style lang="scss">
    .el-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
