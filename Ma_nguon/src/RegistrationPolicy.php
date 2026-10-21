<?php
declare(strict_types=1);

final class RegistrationPolicy
{
    public function decide(int $capacity, int $registered, bool $isClosed, bool $hasWaitingList): string
    {
        // 1. Dữ liệu sai
        if ($capacity <= 0 || $registered < 0 || $registered > $capacity) {
            return 'rejected';
        }

        // 2. Sự kiện đã đóng
        if ($isClosed) {
            return 'rejected';
        }

        // 3. Sự kiện mở và còn chỗ
        if ($registered < $capacity) {
            return 'confirmed';
        }

        // 4. Sự kiện mở, hết chỗ và CÓ danh sách chờ
        if ($hasWaitingList) {
            return 'waiting';
        }

        // 5. Sự kiện mở, hết chỗ và KHÔNG có danh sách chờ
        return 'rejected';
    }
}