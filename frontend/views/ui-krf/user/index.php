<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('application', 'User Page');
?>
<main class="row">
    <!-- Left sidebar -->
    <div class="col-sm-3 col-md-3 left">
        <div class="well well-sm well-title well-side">
            <strong><?= Yii::t('application', 'User Info') ?></strong>
        </div>
        <div class="well well-sm">
            <div class="list-group">
                <?php
                echo Html::a(
                    Yii::t('application', 'Basic'),
                    ['user/index'], ['class' => 'list-group-item active']);
                echo Html::a(
                    Yii::t('application', 'Address'),
                    ['user/address'], ['class' => 'list-group-item']);

                ?>
            </div>
        </div>
    </div>
    <!-- / Left sidebar -->
    <div class="col-sm-9 col-md-9">
        <div class="well well-sm well-title">
            <strong><?= Yii::t('application', 'User Page') ?></strong>
        </div>
        <div class="well well-sm">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a class="accordion-toggle"
                                                   data-toggle="collapse"
                                                   data-parent="#accordion"
                                                   href="#collapse-1"> Lorem
                                ipsum dolor
                                sit amet? </a></h4>
                    </div>
                    <div id="collapse-1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>
                                Anim pariatur cliche reprehenderit, enim eiusmod
                                high
                                life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat
                                skateboard dolor brunch. Food truck quinoa
                                nesciunt laborum eiusmod. Brunch 3 wolf moon
                                tempor,
                                sunt aliqua put a bird on it squid
                                single-origin coffee nulla assumenda shoreditch
                                et.
                                Nihil anim keffiyeh helvetica, craft
                            </p>

                            <p>
                                beer labore wes anderson cred nesciunt sapiente
                                ea
                                proident. Ad vegan excepteur butcher vice
                                lomo. Leggings occaecat craft beer
                                farm-to-table, raw
                                denim aesthetic synth nesciunt you
                                probably haven't heard of them accusamus labore
                                sustainable VHS.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a class="accordion-toggle"
                                                   data-toggle="collapse"
                                                   data-parent="#accordion"
                                                   href="#collapse-2"> Ac
                                facilisis num
                                amispacing? </a></h4>
                    </div>
                    <div id="collapse-2" class="panel-collapse collapse">
                        <div class="panel-body">
                            Aliquam rutrum lorem ac risus. Morbi metus. Vivamus
                            euismod
                            urna. Nullam lobortis quam a felis ullamcorper
                            viverra.
                            Maecenas iaculis aliquet diam. Sed diam lorem,
                            auctor quis,
                            tristique ac, eleifend
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a class="accordion-toggle"
                                                   data-toggle="collapse"
                                                   data-parent="#accordion"
                                                   href="#collapse-3"> Posuere
                                cubilia
                                Curae; Phasellus ornare. Fusce mollis. Duis sit
                                amet? </a></h4>
                    </div>
                    <div id="collapse-3" class="panel-collapse collapse">
                        <div class="panel-body">
                            tellus lorem eu metus. In lorem. Donec elementum,
                            lorem ut
                            aliquam iaculis, lacus pede sagittis augue, eu
                            tempor erat
                            neque non quam. Pellentesque habitant morbi
                            tristique
                            senectus et netus et malesuada fames ac turpis
                            egestas.
                            Aliquam fringilla cursus purus. Nullam scelerisque
                            neque sed
                            sem egestas blandit. Nam nulla magna, malesuada vel,
                            convallis in, cursus et, eros.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a class="accordion-toggle"
                                                   data-toggle="collapse"
                                                   data-parent="#accordion"
                                                   href="#collapse-4"> Amet
                                consectetuer
                                adipiscing elit. Aliquam auctor, velit </a></h4>
                    </div>
                    <div id="collapse-4" class="panel-collapse collapse">
                        <div class="panel-body">
                            non, lacinia at, iaculis quis, pede. Praesent eu
                            dui. Cum
                            sociis natoque penatibus et magnis dis parturient
                            montes,
                            nascetur ridiculus mus. Aenean eget magna.
                            Suspendisse
                            tristique neque venenatis lacus. Etiam bibendum
                            fermentum
                            metus. Aenean sed pede nec ante blandit viverra.
                            Donec
                            tempus, lorem fringilla ornare placerat, orci lacus
                            vestibulum lorem, sit amet ultricies
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>