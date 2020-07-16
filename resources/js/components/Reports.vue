<template>
    <div style="width: 100%;">
        <el-header>
            <span>Reports</span>
            <div class="buttons">
                <el-button @click="toHomePage">To Home page</el-button>
            </div>
        </el-header>
        <el-main>
            <el-table
                    :data="reports"
                    border
                    stripe
                >
                <el-table-column label="Name">
                    <template slot-scope="scope">
                        Exported data
                    </template>
                </el-table-column>
                <el-table-column label="Status" width="180">
                    <template slot-scope="scope">
                        {{ scope.row.result.message }}
                    </template>
                </el-table-column>
                <el-table-column label="File" width="80">
                    <template slot-scope="scope">
                        <a v-if="scope.row.status === 1" :href="scope.row.result.file">file</a>
                    </template>
                </el-table-column>
                <el-table-column
                    width="300"
                    prop="created_at"
                    label="Created at">
                </el-table-column>
            </el-table>
        </el-main>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    export default {
        name: 'Reports',

        data() {
            return {
                reports: []
            };
        },
        mounted() {
            this.reportsList().then(response => {
                this.reports = response.data
            })
        },
        methods: {
            ...mapActions([
                'reportsList'
            ]),

            toHomePage() {
                this.$router.push({ name: 'bookmarks'});
            },
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
</style>
