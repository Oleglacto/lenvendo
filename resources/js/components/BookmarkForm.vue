<template>
    <div>
        <el-dialog :visible.sync="bookmarkFormVisible" title="Make bookmark" :before-close="hideModal">
            <el-form ref="form" :model="bookmark" label-position="top" :rules="validationRules" @submit.native.prevent="onSubmit">
                <el-form-item label="Please enter the link" prop="url" :error="errors.url">
                    <el-input v-model="bookmark.url" @input="clearInputFromAnotherChars">
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

                errors: {
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
            },
            onSubmit() {
                this.errors.url = '';
                this.$refs.form.validate((valid) => {
                    if (valid) {
                        this.makeBookmark(this.bookmark.url)
                            .then(response => {
                                this.$router.push({name: 'bookmark', params: {
                                    bookmark_id: response.data.data.id
                                }});
                            })
                            .catch(error => {
                                _.forOwn(error.response.data.errors, (val, key) => {
                                    this.errors[key] = val[0];
                                })
                                this.$message.error('Oops, this is a error message.');
                            });
                    } else {
                        return false;
                    }
                });
            },
            clearInputFromAnotherChars(input) {
                if (input.length === 1) {
                    return;
                }

                if (input.startsWith('http://')) {
                    this.bookmark.url = input.slice(7, input.length)
                    return;
                }

                if (input.startsWith('https://')) {
                    this.bookmark.url = input.slice(8, input.length)
                    return;
                }
            }
        },
        computed: {

        }
    }
</script>

<style>
</style>
