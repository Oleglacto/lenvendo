<template>
    <div style="width: 100%;">
        <el-header>
            <span>Bookmarks</span>
            <div class="buttons">
                <el-input placeholder="Please input" style="margin-right: 10px;" v-model="searchQuery" class="input-with-select" clearable @clear="loadData">
                    <el-button slot="append" icon="el-icon-search" @click="search"></el-button>
                </el-input>
                <el-button @click="exportToExcel">Export to Excel</el-button>
                <el-button @click="goToFiles">Excel files</el-button>
                <el-button @click="showBookmarkForm">Add bookmark</el-button>
            </div>
        </el-header>
        <el-main>
            <el-table
                :data="bookmarks"
                border
                stripe
                @sort-change="sortCreatedAt"
                >
                <el-table-column
                    prop="title"
                    label="Title"
                    width="300">
                </el-table-column>
                <el-table-column label="Url">
                    <template slot-scope="scope">
                        <a class='favicon' :href="scope.row.url">{{scope.row.url}}</a>
                    </template>
                </el-table-column>
                <el-table-column label="Favicon" width="80">
                    <template slot-scope="scope">
                        <img class='favicon' :src="scope.row.favicon" :alt="scope.row.url">
                    </template>
                </el-table-column>
                <el-table-column
                    sortable="custom"
                    width="300"
                    prop="created_at"
                    label="Created at">
                </el-table-column>
                <el-table-column width="80">
                    <template slot-scope="scope">
                        <el-button size="mini" @click="fullInfo(scope.row)">
                            <i class="el-icon-info"></i>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-pagination
                v-if="bookmarks"
                background
                @current-change="changePage"
                layout="prev, pager, next"
                :total="pagination.total_pages"
                :page-size="pagination.per_page"
                :current-page="pagination.current_page"
            >
            </el-pagination>
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
        name: 'Bookmarks',
        components: {
            BookmarkForm
        },
        data() {
            return {
                bookmarkFormVisible: false,
                bookmarks: [],
                searchQuery: '',
                pagination: {
                    total_pages: 0,
                    per_page: 10,
                    current_page: 1
                }
            };
        },
        mounted() {
            this.loadData()
        },
        methods: {
            ...mapActions([
                'list',
                'makeSearch',
                'makeReport'
            ]),
            loadData() {
                this.list(this.$route.query)
                    .then(response => {
                        this.bookmarks = response.data.data;
                        this.setPagination(response.data);
                    })
                    .catch(() => {
                        this.$message.error('Oops, this is a error message.');
                    });
            },
            search() {
                this.makeSearch({query: this.searchQuery})
                    .then(response => {
                        this.bookmarks = response.data.data;
                        this.setPagination(response.data);
                    })
                    .catch(err => {
                        this.$message.error('Oops, this is a error message.');
                    })
            },
            goToFiles() {
                this.$router.push({ name: 'reports'});
            },
            showBookmarkForm() {
                this.bookmarkFormVisible = true;
            },
            fullInfo(bookmark) {
                this.$router.push({name: 'bookmark', params: {
                    bookmark_id: bookmark.id
                }});
            },
            exportToExcel() {
                this.makeReport().then((response) => {
                    this.$message.info(response.data.data.message);
                })
            },
            sortCreatedAt(params) {
                let order = params.order === 'ascending' ? 'asc' : 'desc';
                let query = {};
                Object.assign(query, this.$route.query);
                query.sortBy = order;
                this.$router.push({ name: 'bookmarks', query }).catch(() => {
                    delete(query.sortBy)
                    this.$router.push({ name: 'bookmarks', query });
                });

                this.list(query).then(response => {
                    this.bookmarks = response.data.data;
                    this.setPagination(response.data);
                });
            },
            changePage(page) {
                let query = {};
                Object.assign(query, this.$route.query);
                query.page = page;
                this.$router.push({ name: 'bookmarks', query });
                this.list(query).then(response => {
                    this.bookmarks = response.data.data;
                    this.setPagination(response.data);
                });
            },

            setPagination(response) {
                this.pagination.current_page = response.meta.current_page;
                this.pagination.total_pages = response.meta.total;
                this.pagination.per_page = response.meta.per_page;
            }

        },
        computed: {

        }
    }
</script>

<style lang="scss">
    .buttons {
        display: flex;
    }
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
</style>
