# simulate-midtrans.ps1
# PowerShell script to simulate Midtrans webhook to local app (via ngrok)
# Usage: set the variables below and run in PowerShell.

# --- CONFIG ---
$NgrokUrl = "https://REPLACE_WITH_NGROK_URL"   # e.g. https://abcd-1234.ngrok.io
$OrderNumber = "ORD-FZUWAN0BTW"               # order_number (will be prefixed in Midtrans order_id)
$StatusCode = "200"
$Gross = "4600361"
$TransactionStatus = "settlement"             # capture | settlement | pending | deny | expire | cancel
$TransactionId = "tran-TEST-" + (Get-Random -Maximum 1000000)
$PaymentType = "bank_transfer"
$FraudStatus = "accept"                       # accept | challenge
$ServerKey = "REPLACE_WITH_MIDTRANS_SERVER_KEY"

# Construct the same order_id format used by the app: {order_number}-{order_id}-{uniq}
# We'll just attach a random suffix to simulate Midtrans value
$MidtransOrderId = "$OrderNumber-" + (Get-Random -Maximum 99999)

# Compute signature_key = sha512(order_id + status_code + gross_amount + server_key)
$concat = $MidtransOrderId + $StatusCode + $Gross + $ServerKey
$sha = [System.Security.Cryptography.SHA512]::Create()
$bytes = [System.Text.Encoding]::UTF8.GetBytes($concat)
$hash = $sha.ComputeHash($bytes)
$Signature = ([System.BitConverter]::ToString($hash)).Replace("-", "").ToLower()

$payload = @{
    order_id = $MidtransOrderId
    status_code = $StatusCode
    gross_amount = $Gross
    transaction_status = $TransactionStatus
    transaction_id = $TransactionId
    payment_type = $PaymentType
    fraud_status = $FraudStatus
    signature_key = $Signature
}

Write-Host "Posting simulated Midtrans notification to $NgrokUrl/midtrans/notification"
Write-Host "payload:`n" ($payload | ConvertTo-Json -Depth 5)

Invoke-RestMethod -Uri "$NgrokUrl/midtrans/notification" -Method Post -Body ($payload | ConvertTo-Json -Depth 5) -ContentType "application/json" -ErrorAction Stop
Write-Host "Done. Check laravel.log for processing result."