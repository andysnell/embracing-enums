<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums;

enum HttpMethod: string
{
    public const string GET = 'GET';
    public const string POST = 'POST';
    public const string PUT = 'PUT';
    public const string PATCH = 'PATCH';
    public const string DELETE = 'DELETE';
    public const string OPTIONS = 'OPTIONS';
    public const string HEAD = 'HEAD';
    public const string TRACE = 'TRACE';
    public const string CONNECT = 'CONNECT';

    case Get = self::GET;
    case Post = self::POST;
    case Put = self::PUT;
    case Patch = self::PATCH;
    case Delete = self::DELETE;
    case Options = self::OPTIONS;
    case Head = self::HEAD;
    case Trace = self::TRACE;
    case Connect = self::CONNECT;
}
