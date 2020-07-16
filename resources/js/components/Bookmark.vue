<template>
    <div style="width: 100%;">
        <el-header>
            <span>Bookmarks</span>
            <div class="buttons">
                <el-button @click="showBookmarkForm">Add bookmark</el-button>
                <el-button @click="toHomePage">To Home page</el-button>
            </div>
        </el-header>
        <el-main>
            <el-card class="box-card" style="max-width: 400px">
                <div slot="header" class="clearfix">
                    <span>{{ bookmark.url }}</span>
                </div>
                <div class="text item">
                    Title: {{ bookmark.title || 'Title is missing' }}
                </div>
                <div class="text item">
                    Url: <a :href="bookmark.url">{{ bookmark.url }}</a>
                </div>
                <div class="text item">
                    Favicon: <img class='favicon' :src="bookmark.favicon" :alt="bookmark.url">
                </div>
                <div class="text item">
                    Description: {{  bookmark.description || 'Description is missing' }}
                </div>
                <div class="text item">
                    Keywords: {{  bookmark.keywords || 'Keywords is missing' }}
                </div>
                <div class="text item">
                    Created_at: {{  bookmark.created_at }}
                </div>
            </el-card>
        </el-main>
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
        name: 'Bookmark',
        components: {
            BookmarkForm
        },
        data() {
            return {
                bookmarkFormVisible: false,
                bookmark: {},
            };
        },
        created() {
            this.getBookmark(this.$route.params.bookmark_id).then((response) => {
                this.bookmark = response.data.data;
            }).catch(err => {
                console.log(err);
                if (err.response.status === 404) {
                    this.$router.push({name: 'not_found'});
                }
            });
        },
        methods: {
            ...mapActions([
                'getBookmark'
            ]),
            toHomePage() {
                this.$router.push({ name: 'bookmarks'});
            },
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
    .favicon {
        width: 30px;
        height: 30px;
    }

    .el-pagination.is-background {
        margin-top: 20px;
        margin-left: -10px;
    }

    .text {
        font-size: 14px;
    }

    .item {
        margin-bottom: 18px;
    }
</style>
