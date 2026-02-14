<?php
/**
 * Rate Limiter for Login Protection
 * Prevents brute force attacks by limiting failed login attempts
 */

class RateLimiter {
    private $storage_dir;
    private $max_attempts;
    private $lockout_time;
    
    public function __construct($max_attempts = 5, $lockout_time = 900) {
        $this->storage_dir = __DIR__ . '/../rate_limit_data/';
        $this->max_attempts = $max_attempts;
        $this->lockout_time = $lockout_time; // 15 minutes in seconds
        
        if (!is_dir($this->storage_dir)) {
            @mkdir($this->storage_dir, 0755, true);
        }
    }
    
    private function getFilePath($ip) {
        return $this->storage_dir . md5($ip) . '.json';
    }
    
    private function cleanIP($ip) {
        return preg_replace('/[^0-9a-fA-F:.]/', '', $ip);
    }
    
    public function isBlocked($ip) {
        $ip = $this->cleanIP($ip);
        $file = $this->getFilePath($ip);
        
        if (!file_exists($file)) {
            return false;
        }
        
        $data = json_decode(file_get_contents($file), true);
        
        if (!$data) {
            return false;
        }
        
        // Check if lockout has expired
        if (isset($data['locked_until']) && time() < $data['locked_until']) {
            return true;
        }
        
        // Check if attempts exceed max within window
        if (isset($data['attempts']) && $data['attempts'] >= $this->max_attempts) {
            if (time() < $data['last_attempt'] + $this->lockout_time) {
                return true;
            } else {
                // Lockout expired, reset
                $this->reset($ip);
                return false;
            }
        }
        
        return false;
    }
    
    public function getRemainingTime($ip) {
        $ip = $this->cleanIP($ip);
        $file = $this->getFilePath($ip);
        
        if (!file_exists($file)) {
            return 0;
        }
        
        $data = json_decode(file_get_contents($file), true);
        
        if (isset($data['locked_until'])) {
            return max(0, $data['locked_until'] - time());
        }
        
        if (isset($data['last_attempt'])) {
            return max(0, ($data['last_attempt'] + $this->lockout_time) - time());
        }
        
        return 0;
    }
    
    public function recordFailure($ip) {
        $ip = $this->cleanIP($ip);
        $file = $this->getFilePath($ip);
        
        $data = ['attempts' => 0, 'last_attempt' => 0];
        
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true) ?: $data;
        }
        
        $data['attempts'] = ($data['attempts'] ?? 0) + 1;
        $data['last_attempt'] = time();
        
        if ($data['attempts'] >= $this->max_attempts) {
            $data['locked_until'] = time() + $this->lockout_time;
        }
        
        file_put_contents($file, json_encode($data));
    }
    
    public function reset($ip) {
        $ip = $this->cleanIP($ip);
        $file = $this->getFilePath($ip);
        
        if (file_exists($file)) {
            @unlink($file);
        }
    }
}

/**
 * Get client IP address
 */
function get_client_ip() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    // Check for proxy headers (be careful with these in production)
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ips[0]);
    }
    
    return $ip;
}
?>
