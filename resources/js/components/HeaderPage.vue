<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-12">
                    <div class="btns-route-wrapper">
                        <button @click="$router.go(-1)" type="button" class="back-route btn btn-outline-secondary"><i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left'"></i></button>
                        <button @click="$router.go(1)" type="button" class="back-route btn btn-outline-secondary"><i class="fas" :class="$i18n.locale == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right'"></i></button>
                    </div>
                    <h2 class="m-0 text-dark title-page-global">
                        <slot></slot>
                    </h2>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
</template>
