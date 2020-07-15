<template>
    <div>
        <el-dialog :visible.sync="bookmarkFormVisible" title="Make bookmark" :before-close="hideModal">
            <el-form ref="form" :model="bookmark" label-position="top" :rules="validationRules" @submit.native.prevent="onSubmit">
                <el-form-item label="Please enter the link" prop="url">
                    <el-input v-model="bookmark.url">
                        <template slot="prepend">https://</template>
                    </el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">Make</el-button>
                    <el-button @click="hideModal">Cancel</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    export default {
        name: 'BookmarkForm',
        components: {
        },
        props: {
            bookmarkFormVisible: {
                type: Boolean,
                default: false
            },
        },
        data() {
            return {
                bookmark: {
                    url: '',
                },

                validationRules: {
                    url: [
                        {required: true, message: 'Please input url', trigger: 'blur'},
                    ],
                }
            };
        },
        mounted() {
        },
        methods: {
            ...mapActions([
                'makeBookmark'
            ]),
            hideModal() {
                this.$emit('bookmarkFormClosed');
                this.room = {}
            },
            onSubmit() {
                this.$refs.form.validate((valid) => {
                    if (valid) {
                        this.makeBookmark(this.bookmark.url);
                    } else {
                        return false;
                    }
                });
            }
        },
        computed: {

        }
    }
</script>

<style>
</style>
