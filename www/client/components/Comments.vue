<template>
    <!-- Komentáře -->
    <div id='comment-section'>
        <el-tabs v-model="tab" type="card">
            <el-tab-pane label="Komentáře" name="1">
                <!-- Hashover -->
                <div id="hashover"></div>
            </el-tab-pane>
            <el-tab-pane label="Facebook komentáře" name="2">
                <!-- Komentářová sekce -->
                <div class='fb-comments'
                    data-width='100%'
                    data-numposts='5'
                    :data-href='url'></div>
                <!-- Notice -->
                <p class="comment-notice">
                    <strong>Facebook komentáře již nejsou z kapacitních důvodů monitorovány!</strong> Kvůli vyhlášce EU (ePrivacy Directive - ePD) je pro zobrazení komentářové sekce nutné být přihlášen na Facebooku a uživatelé prohlížeče Safari musí povolit sledování napříč stránkami (<strong>Safari</strong> - <strong>Předvolby...</strong> - <strong>Soukromí</strong> - odškrtnout <strong>Bránit ve sledování napříč stránkami</strong>.)
                </p>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    module.exports = {
        // Data komponenty
        data: function() {
            return {
                url: '',
                tab: '1'
            }
        },
        // Atributy komponenty
        props: {
            //  Identifikátor dokumentu
            did: {
                required: true
            }
        },
        // Když je komponenta vytvořena
        mounted() {
            // Získá aktuální URL a připojí kotvičku s ID dokumentu
            this.url = `${window.location.href}#${this.did}`;

            // Vytvoří script s odkazem na facebookovou SDK a vloží
            // script do hlavičky. Díky tomu SDK načítáme pouze tehdy,
            // kdy ji opravdu potřebujeme.
            let script = document.createElement('script');
            script.setAttribute('src', 'https://connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v5.0');
            document.head.appendChild(script);

            // Hashover
            setTimeout(_ => {
                let script2 = document.createElement('script');
                script2.setAttribute('src', '/hashover/comments.php');
                document.body.appendChild(script2);
            }, 1000);
        }
    }
</script>

<style lang='scss'>
    // Facebook komentářový box má odsazení
    // 8 pixelů po každé straně. Upravíme
    // šířku kontejneru a vycentrujeme obsah
    // pro správné zarovnání se zbytkem dokumentu:
    #comment-section {
        // Roztáhne kontenjner o šíři odsazení
        width: calc(100% + 16px);
        margin-top: 20px;
    }

    // Roztáhne komentářovou sekci
    #comment-section iframe {
        // Šířka
        width: 100% !important;

        // Odsazení
        margin-top: 15px;
    }
    
    .comment-notice {
        opacity: .25;
        margin-top: 25px;
        font-size: 0.9em;
        text-align: justify;
        padding-right: 16px;
    }

    .fb-comments {
        margin-left: -8px;
    }

    // Přestyluje hashover
    .hashover-title {
        margin-top: 10px !important;
    }

    .hashover-form {
        background: transparent !important;
        border: 1px solid #E3E7ED !important;
        border-radius: 4px !important;
    }

    .hashover-inputs {
        background: #F8F8F8 !important;
        border: none !important;
        border-top-left-radius: 4px !important;
        border-top-right-radius: 4px !important;
        overflow: hidden;
    }

    .hashover-textarea.hashover-main-textarea {
        border: none !important;
        border-top: 1px solid #E3E7ED !important;
        background: white !important;
    }

    .hashover input:focus, .hashover textarea:focus, .hashover .hashover-submit:focus:focus {
        border-color: #E3E7ED !important;
    }

    .hashover-formatting-table {
        background: #F8F8F8 !important;
        border-color: #E3E7ED !important;
    }

    .hashover-form-footer {
        background: white !important;
        border: none !important;
        border-bottom-left-radius: 4px !important;
        border-bottom-right-radius: 4px !important;
    }

    .hashover-submit {
        padding: 10px 15px !important;
        border-radius: 4px !important;
        border: 1px solid #DCDFE6 !important;
        border-bottom: 2px solid rgba(0, 0, 0, .2) !important;
        background: white !important;
        color: #606266 !important;
    }

    .hashover-submit:hover {
        background-color: #E6EDF2 !important;
        color: #00497B !important;
        border-color: #A6BFD0 !important;
    }

    .hashover-submit.hashover-post-button {
        background-color: #00497B !important;
        color: white !important;
        border-color: #056591 !important;
    }

    .hashover-submit.hashover-post-button:hover {
        background-color: #336D96 !important;
        color: white !important;
    }

    .hashover-comment {
        border: 1px solid #E3E7ED !important;
        border-radius: 4px !important;
    }

    .hashover-header {
        background: white !important;
    }

    .hashover-comment-name.hashover-name-plain {
        opacity: .55 !important;
    }

    .hashover-avatar-image {
        border-radius: 4px !important;
    }

    .hashover-avatar-image * {
        border: none !important;
    }
</style>