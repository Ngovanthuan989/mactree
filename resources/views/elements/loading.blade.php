<style>
    body {
        margin: 0px !important;
    }

    #body-loader {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(18, 28, 33, 0.2);
        width: 100%;
        justify-content: center;
        align-items: center;
        display: none;
        z-index: 9999;
    }

    #loader {
        position: absolute;
    }

    #loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #006C9A;
        border-bottom: 16px solid #006C9A;
        width: 80px;
        height: 80px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div id="body-loader">
    <div id="loader"></div>
</div>

<script>
    var Loading = {
        show: function() {
            document.getElementById('body-loader').style.display = 'flex';
        },
        hide: function () {
            document.getElementById('body-loader').style.display = 'none';
        }
    }
</script>
