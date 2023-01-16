<?php

$facture = getFacture()

?>

<div class="header">
        <div class="ref">
            Facture <i class="fa fa-arrow-right"></i> #{{ id }}
        </div>
        <div class="options">
        </div>
    </div>
    <div class="divided"></div>
    <div class="title">
        <div class="logo">
            <img src="{{ source('img/logo.png') }}" alt="">
        </div>
        <div class="text">
            Smarter Company
        </div>
    </div>
    <div class="desc">
        <div class="desc-client">
            <div>
                <span>noms</span> : 
                <span class="client-response">
                    {{ invoice.name ~ ' '  ~ invoice.lastname}}
                </span>
            </div>
            <div>
                <span>téléphone</span> :
                <span class="client-response"> {{ invoice.phone }}</span>
            </div>
            <div>
                <span>sexe</span> :
                <span class="client-response"> {{ invoice.sexe }}</span>
            </div>
            <div>
                <span>email</span> :
                <span class="client-response"> {{ invoice.email }}</span>
            </div>
        </div>
        <div class="desc-company">
            <div>
                <span> id</span> :
                <span class="company-response"> #{{ invoice.id }} </span>
            </div>
            <div>
                <span> date</span> :
                <span class="company-response"> {{ invoice.createAt }}</span>
            </div>
            <div>
                <span> mode</span> :
                <span class="company-response"> par {{ invoice.rmobile }}</span>
            </div>
            <div>
                <span> numéro</span> :
                <span class="company-response"> {{ invoice.tel }} </span>
            </div>
            <div>
                <span> paiement</span> :
                {% if invoice.payment == true %}
                <span class="status ok"> payé </span>
                {% else %}
                    <span class="status no"> pas encore </span>
                {% endif %}
            </div>
        </div>
    </div>

    <div class="rule">
        <p>Nous activerons votre compte de que vous allez effectuer le virement, si vous avez déjà effectuer le virement et que votre compte n'est toujours pas activer, veuillez contacter notre service clientel sur <strong>smarter-company@gmail.com</strong></p>
    </div>
    <table>
        <thead>
            <tr>
                <th>description</th>
                <th>niveau d'accès</th>
                <th>durée</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    suivre les formations en ligne
                </td>
                <td>total</td>
                <td>à  vie</td>
            </tr>
            <tr>
                <td>
                    suivre les formations en présentielle
                </td>
                <td>total</td>
                <td>à vie</td>
            </tr>
            <tr>
                <td>
                    suivre les conférences
                </td>
                <td>total</td>
                <td>à vie</td>
            </tr>
        </tbody>
    </table>

    <div class="prices">
        <div class="price">
            <span>Total en Fc : </span>
            <span class="p">{{ price.franc }} fc</span>
        </div>
        <div class="price">
            <span>Total en dollard : </span>
            <span class="p">{{ price.dollard }} $</span>
        </div>
    </div>

    <a href="" class="check" id="verify">vérifié</a>