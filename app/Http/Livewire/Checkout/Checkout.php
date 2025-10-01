<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Checkout extends Component
{
    public $stats = [];
    public $transactions = [];
    public $paymentMethods = [];
    public $recentActivity = [];
    public $selectedPeriod = 'today';

    protected $listeners = ['refreshCheckoutData' => 'refreshData'];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->loadStats();
        $this->loadTransactions();
        $this->loadPaymentMethods();
        $this->loadRecentActivity();
    }

    private function loadStats()
    {
        $this->stats = Cache::remember('checkout_stats', 300, function () {
            return [
                'total_sales' => [
                    'value' => '€12,458',
                    'change' => '+12.5%',
                    'change_type' => 'positive',
                    'icon' => 'fas fa-shopping-cart'
                ],
                'transactions' => [
                    'value' => '1,248',
                    'change' => '+8.2%',
                    'change_type' => 'positive',
                    'icon' => 'fas fa-credit-card'
                ],
                'success_rate' => [
                    'value' => '98.2%',
                    'change' => '+1.5%',
                    'change_type' => 'positive',
                    'icon' => 'fas fa-chart-line'
                ],
                'avg_order' => [
                    'value' => '€89.50',
                    'change' => '+3.2%',
                    'change_type' => 'positive',
                    'icon' => 'fas fa-euro-sign'
                ]
            ];
        });
    }

    private function loadTransactions()
    {
        $this->transactions = Cache::remember('recent_transactions', 300, function () {
            return [
                [
                    'id' => 'TRX-001',
                    'customer' => 'Jean Dupont',
                    'amount' => '€125.00',
                    'method' => 'Carte Bancaire',
                    'status' => 'completed',
                    'date' => now()->subMinutes(15)->format('H:i')
                ],
                [
                    'id' => 'TRX-002',
                    'customer' => 'Marie Martin',
                    'amount' => '€89.99',
                    'method' => 'PayPal',
                    'status' => 'completed',
                    'date' => now()->subMinutes(30)->format('H:i')
                ],
                [
                    'id' => 'TRX-003',
                    'customer' => 'Pierre Moreau',
                    'amount' => '€245.50',
                    'method' => 'Carte Bancaire',
                    'status' => 'pending',
                    'date' => now()->subHours(1)->format('H:i')
                ],
                [
                    'id' => 'TRX-004',
                    'customer' => 'Sophie Leroy',
                    'amount' => '€67.80',
                    'method' => 'Stripe',
                    'status' => 'failed',
                    'date' => now()->subHours(2)->format('H:i')
                ],
                [
                    'id' => 'TRX-005',
                    'customer' => 'Thomas Robert',
                    'amount' => '€156.00',
                    'method' => 'Apple Pay',
                    'status' => 'completed',
                    'date' => now()->subHours(3)->format('H:i')
                ]
            ];
        });
    }

    private function loadPaymentMethods()
    {
        $this->paymentMethods = [
            [
                'name' => 'Carte Bancaire',
                'icon' => 'fas fa-credit-card',
                'amount' => '€8,245',
                'percentage' => '65%',
                'active' => true
            ],
            [
                'name' => 'PayPal',
                'icon' => 'fab fa-paypal',
                'amount' => '€2,890',
                'percentage' => '23%',
                'active' => false
            ],
            [
                'name' => 'Stripe',
                'icon' => 'fas fa-credit-card',
                'amount' => '€1,125',
                'percentage' => '9%',
                'active' => false
            ],
            [
                'name' => 'Apple Pay',
                'icon' => 'fab fa-apple',
                'amount' => '€450',
                'percentage' => '3%',
                'active' => false
            ]
        ];
    }

    private function loadRecentActivity()
    {
        $this->recentActivity = [
            [
                'icon' => 'fas fa-shopping-cart',
                'title' => 'Nouvelle commande',
                'description' => 'Commande #ORD-001 créée',
                'time' => 'Il y a 5 min'
            ],
            [
                'icon' => 'fas fa-credit-card',
                'title' => 'Paiement validé',
                'description' => 'Paiement #PAY-002 approuvé',
                'time' => 'Il y a 15 min'
            ],
            [
                'icon' => 'fas fa-exchange-alt',
                'title' => 'Remboursement',
                'description' => 'Remboursement #REF-001 traité',
                'time' => 'Il y a 1 heure'
            ],
            [
                'icon' => 'fas fa-exclamation-triangle',
                'title' => 'Paiement échoué',
                'description' => 'Tentative de paiement échouée',
                'time' => 'Il y a 2 heures'
            ]
        ];
    }

    public function exportTransactions()
    {
        // Logique d'exportation
        $this->dispatchBrowserEvent('notification', [
            'type' => 'success',
            'title' => 'Export réussi',
            'message' => 'Les transactions ont été exportées avec succès.'
        ]);
    }

    public function processRefund($transactionId)
    {
        // Logique de remboursement
        $this->dispatchBrowserEvent('notification', [
            'type' => 'info',
            'title' => 'Remboursement initié',
            'message' => 'Le remboursement a été initié avec succès.'
        ]);
    }

    public function render()
    {
        return view('livewire.checkout.checkout');
    }
}
